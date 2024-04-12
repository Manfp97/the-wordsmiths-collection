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
		"./node_modules/flowbite/**/*.js",
	],
	theme: {
		colors: {
			skin: {
				primary: withOpacity("--color-primary"),
				"primary-offset": withOpacity("--color-primary-offset"),
				secondary: withOpacity("--color-secondary"),
				"secondary-offset": withOpacity("--color-secondary-offset"),
				tertiary: withOpacity("--color-tertiary"),
				text: withOpacity("--color-text"),
				muted: withOpacity("--color-muted"),
				link: withOpacity("--color-link"),
				success: withOpacity("--color-success"),
				"success-light": withOpacity("--color-success-light"),
				warning: withOpacity("--color-warning"),
				"warning-light": withOpacity("--color-warning-light"),
				danger: withOpacity("--color-danger"),
				"danger-light": withOpacity("--color-danger-light"),
				card: withOpacity("--color-card"),
				border: withOpacity("--color-border"),
				transparent: "transparent",
				white: "white",
			},
		},
		fontFamily: {
			helvetica: ["Helvetica", "sans-serif"],
			poppins: ["Poppins", "sans-serif"],
			"means-web": ["Means Light Web", "sans-serif"],
		},
		screens: {
			xs: { min: "480px" },
			sm: { min: "640px" },
			md: { min: "768px" },
			lg: { min: "1024px" },
			xl: { min: "1280px" },
			"2xl": { min: "1536px" },
			"max-xs": { max: "479px" },
			"max-sm": { max: "639px" },
			"max-md": { max: "767px" },
			"max-lg": { max: "1023px" },
			"max-xl": { max: "1279px" },
			"max-2xl": { max: "1535px" },
		},
	},
	plugins: [require("flowbite/plugin")],
};
