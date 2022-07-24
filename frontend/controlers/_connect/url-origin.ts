interface Origin {
  backend: string;
}

/*+ 各環境のorigin、末尾スラッシュなし */
export const Origin = ((): Origin => {
  let backend = import.meta.env.ORIGIN_BACKEND;
  if (typeof backend !== 'string') {
    backend = 'http://localhost:55002';
  }
  return { backend };
})();
