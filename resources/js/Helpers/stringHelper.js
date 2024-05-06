import { getActiveLanguage } from "laravel-vue-i18n";

export const getFormattedDate = (
	stringIso8601,
	options = { day: "numeric", month: "numeric", year: "numeric" }
) => {
	const date = stringIso8601 ? new Date(stringIso8601) : null;
	const formattedDate =
		date?.toLocaleString(getActiveLanguage(), options) ?? "-";
	return formattedDate;
};
