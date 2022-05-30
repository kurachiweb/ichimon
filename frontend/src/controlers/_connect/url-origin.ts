interface Origin {
  backend: string;
}

/*+ 各環境のorigin、末尾スラッシュなし */
export const Origin = ((): Origin => {
  let backend = process.env.VUE_APP_ORIGIN_BACKEND;
  if (!backend) {
    backend = 'http://localhost:55002';
  }
  return { backend };
})();
