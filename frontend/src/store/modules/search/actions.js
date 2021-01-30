export function changeSearchValue(value) {
  return {
    type: '@search/CHANGE',
    payload: { value },
  };
}