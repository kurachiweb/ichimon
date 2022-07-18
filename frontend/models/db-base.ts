/** DBテーブル基本カラム */
export interface ColumnBase {
  created_at: string;
  updated_at: string;
  deleted_at: string | null;
}

/** DBテーブル基本カラムのデフォルト値 */
export const DefaultColumnBase = (): ColumnBase => ({
  created_at: '',
  updated_at: '',
  deleted_at: null
});
