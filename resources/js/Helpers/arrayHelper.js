export const extractKeyValuesByPattern = (
	object,
	pattern,
	splitBy,
	atIndex
) => {
	const array = [];

	for (const key in object) {
		if (key.startsWith(pattern)) {
			const index = key.split(splitBy)[atIndex];
			const value = object[key];
			array.push({ key, value, index });
		}
	}

	return array.length ? array : null;
};
