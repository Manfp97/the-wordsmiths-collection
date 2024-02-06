export const capitalized = (text) => {
	const capitalizedFirst = text[0].toUpperCase();
	const rest = text.slice(1);
	return capitalizedFirst + rest;
};
