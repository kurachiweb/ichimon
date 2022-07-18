/** 各環境のOrigin、インポート行数を減らして使えるように */
export { Origin } from '@/controlers/_connect/url-origin';

/** リクエストオプション */
export interface FetchOptionCustom {
  method?: string; // HTTPメソッド
  requestType?: string; // リクエストの形式
  responseType?: string; // 期待するレスポンスの形式
  withCredentials?: boolean; // リクエストに視覚情報も含めるか
  allowCrossOrigin?: boolean; // 別オリジンに対するリクエストを許容するか
}

/** サーバーからの想定レスポンス */
export interface FetchCustomResponse<Res> {
  message: string;
  data: Res | null;
}

/** ネットワーク接続のエラー時処理 */
const onFetchError = (response: Response) => {
  // ステータスコードは2xx以外になる
  throw new Error('HTTP error: status = ' + response.status);
};

/** ネットワークからリソースを取得 */
export const Fetch = <Res>(
  url: string,
  data?: BodyInit | null,
  option?: FetchOptionCustom
): Promise<FetchCustomResponse<Res>> => {
  if (option == null) {
    option = {};
  }

  const request: RequestInit = {};
  request.headers = new Headers();

  // HTTPメソッド
  // 未指定ならGET
  if (option.method !== undefined) {
    request.method = option.method.toUpperCase();
  } else {
    request.method = 'GET';
  }

  // リクエストボディ
  if (data != null) {
    // GRTやHEADの場合、bodyは使用できない
    if (request.method !== 'GET' && request.method !== 'HEAD') {
      request.body = data;
    }
  }

  // MIMEタイプ
  let mimeType = '';
  // バイナリデータなら、そのMIMEタイプが指定値となる
  if (data instanceof Blob) {
    mimeType = data.type;
  }
  // オプションでリクエストMIMEタイプが指定されていれば、それを強制する
  switch (option.requestType) {
    case 'json':
      mimeType = 'application/json';
      break;
  }
  if (mimeType) {
    // 指定されていれば、MIMEタイプを設定する
    // 指定ヘッダが既にあって、複数の値を受け入れる場合、append()は上書きでなく追加する
    request.headers.append('Content-Type', mimeType);
  }

  // 別オリジンの許可
  if (option.allowCrossOrigin === true) {
    request.mode = 'cors';
  }

  // 認証情報の扱い
  if (option.withCredentials === true) {
    request.credentials = 'include';
  }

  // 期待するレスポンスの形式、デフォルトはテキスト形式
  let responseType = '';
  if (option != null && option.responseType != null) {
    responseType = option.responseType;
  }

  return new Promise((resolve, reject) => {
    fetch(url, request)
      .then(res => {
        if (!res.ok) {
          // 通信の過程でエラーがあった場合
          reject(res);
          // ネットワーク接続のエラー時処理
          onFetchError(res);
          return;
        }
        switch (responseType) {
          case 'json':
            return res.json();
          case 'blob':
            return res.blob();
          default:
            return res.text();
        }
      })
      .then(body => resolve(body))
      .catch(reason => reject(reason)); // 通信できなかった場合
  });
};

/** JSON形式でリクエストし、JSON形式でリソースを取得 */
export const FetchJson = <Req, Res>(
  url: string,
  data?: Req | null,
  option?: FetchOptionCustom
) => {
  if (option == null) {
    option = {};
  }

  // JSON通信において、HTTPメソッドはPOSTをデフォルトとする
  if (option.method === undefined) {
    option.method = 'POST';
  }
  option.requestType = 'json';
  option.responseType = 'json';

  // オブジェクトをJSON文字列に変換、nullはそのまま
  let requestBody;
  if (data != null) {
    requestBody = JSON.stringify(data);
  }

  return Fetch<Res>(url, requestBody, option);
};

/** JSON APIを利用し、リソースを取得 */
export const FetchApiJson = <Req, Res>(
  url: string,
  data?: Req | null,
  option?: FetchOptionCustom
) => {
  if (option == null) {
    option = {};
  }

  // クロスオリジンでもCookieを送信
  option.allowCrossOrigin = true;
  option.withCredentials = true;

  return FetchJson<Req, Res>(url, data, option);
};
