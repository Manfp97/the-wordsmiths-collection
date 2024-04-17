export const capitalized = (text) => {
	const capitalizedFirst = text[0].toUpperCase();
	const rest = text.slice(1);
	return capitalizedFirst + rest;
};

export const getFormattedDate = (
	stringIso8601,
	options = { day: "numeric", month: "numeric", year: "numeric" }
) => {
	const date = stringIso8601 ? new Date(stringIso8601) : null;
	const formattedDate = date?.toLocaleString("default", options) ?? "-";
	return formattedDate;
};
