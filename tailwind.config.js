function withOpacity(variableName) {
	return ({ opacityValue }) => {
		if (opacityValue !== undefined) {
			return `rgba(var(${variableName}), ${opacityValue})`;
		}
		return `rgb(var(${variableName}))`;
	};
}

/** @type {import('tailwindcss').Config} */
export default {
	content: [
		"./resources/**/*.blade.php",
		"./resources/**/*.js",
		"./resources/**/*.vue",
	],
	theme: {
		colors: {
			skin: {
				primary: withOpacity("--color-primary"),
				secondary: withOpacity("--color-secondary"),
				tertiary: withOpacity("--color-tertiary"),
				text: withOpacity("--color-text"),
				card: withOpacity("--color-card"),
				border: withOpacity("--color-border"),
			},
		},
		fontFamily: {
			helvetica: ["Helvetica", "sans-serif"],
			poppins: ["Poppins", "sans-serif"],
			"means-web": ["Means Light Web", "sans-serif"],
		},
		extend: {
			screens: {
				"max-xs": { max: "479px" },
				"max-sm": { max: "639px" },
				"max-md": { max: "767px" },
				"max-lg": { max: "1023px" },
				"max-xl": { max: "1199px" },
			},
		},
	},
	plugins: [],
};
