const getUnique = (arr, field) => {
  // store the comparison  values in array
  const unique = arr
    .map((e) => e[field])

    // store the indexes of the unique objects
    .map((e, i, final) => final.indexOf(e) === i && i)

    // eliminate the false indexes & return unique objects
    .filter((e) => arr[e])
    .map((e) => arr[e]);

  return unique;
};

export default getUnique;
