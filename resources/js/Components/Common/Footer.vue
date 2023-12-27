<script setup>
const socials = [
	{
		id: 1,
		title: "GitHub profile",
		link: "https://github.com/henestrosadev",
		svg: `
			<svg
				xmlns="http://www.w3.org/2000/svg"
				width="24"
				height="24"
				fill="currentColor"
				className="hover:fill-skin-primary"
			>
				<path
					fillRule="evenodd"
					clipRule="evenodd"
					d="M12.026 2c-5.509 0-9.974 4.465-9.974 9.974 0 4.406 2.857 8.145 6.821 9.465.499.09.679-.217.679-.481 0-.237-.008-.865-.011-1.696-2.775.602-3.361-1.338-3.361-1.338-.452-1.152-1.107-1.459-1.107-1.459-.905-.619.069-.605.069-.605 1.002.07 1.527 1.028 1.527 1.028.89 1.524 2.336 1.084 2.902.829.091-.645.351-1.085.635-1.334-2.214-.251-4.542-1.107-4.542-4.93 0-1.087.389-1.979 1.024-2.675-.101-.253-.446-1.268.099-2.64 0 0 .837-.269 2.742 1.021a9.582 9.582 0 0 1 2.496-.336 9.554 9.554 0 0 1 2.496.336c1.906-1.291 2.742-1.021 2.742-1.021.545 1.372.203 2.387.099 2.64.64.696 1.024 1.587 1.024 2.675 0 3.833-2.33 4.675-4.552 4.922.355.308.675.916.675 1.846 0 1.334-.012 2.41-.012 2.737 0 .267.178.577.687.479C19.146 20.115 22 16.379 22 11.974 22 6.465 17.535 2 12.026 2z"
				/>
			</svg>
		`,
	},
	{
		id: 2,
		title: "X profile",
		link: "/#",
		svg: `
			<svg 
				xmlns="http://www.w3.org/2000/svg" 
				class="icon icon-tabler icon-tabler-brand-x" 
				width="24" 
				height="24" 
				stroke-width="2" stroke="currentColor" 
				fill="none" 
				stroke-linecap="round" 
				stroke-linejoin="round"
			>
				<path  stroke="none" d="M0 0h24v24H0z"  fill="none" />
				<path d="M4 4l11.733 16h4.267l-11.733 -16z" />
				<path d="M4 20l6.768 -6.768m2.46 -2.46l6.772 -6.772" />
			</svg>
		`,
	},
	{
		id: 3,
		title: "Instagram",
		link: "/#",
		svg: `
			<svg 
				xmlns="http://www.w3.org/2000/svg" 
				class="icon icon-tabler icon-tabler-brand-instagram" 
				width="24" 
				height="24"
				stroke-width="2" 
				stroke="currentColor" 
				fill="none" 
				stroke-linecap="round" 
				stroke-linejoin="round"
			>
				<path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4m0 4a4 4 0 0 1 4 -4h8a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4z" />
				<path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
				<path d="M16.5 7.5l0 .01" />
			</svg>
		`,
	},
	{
		id: 4,
		title: "Email",
		link: "mailto:henestrosadev@gmail.com",
		svg: `
			<svg
				xmlns="http://www.w3.org/2000/svg"
				width="24"
				height="24"
				viewBox="0 0 24 24"
				fill="currentColor"
				className="hover:fill-skin-primary"
			>
				<path d="M20 4H4c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2zm0 2v.511l-8 6.223-8-6.222V6h16zM4 18V9.044l7.386 5.745a.994.994 0 0 0 1.228 0L20 9.044 20.002 18H4z"></path>
			</svg>
		`,
	},
];
</script>

<template>
	<div
		class="sticky top-[100vh] mx-auto flex w-full items-center justify-center bg-skin-tertiary text-skin-primary"
	>
		<footer class="py-10 text-center">
			<div class="mb-4 mt-2 flex justify-center space-x-12">
				<!-- eslint-disable vue/no-v-html -->
				<a
					v-for="social in socials"
					:key="social.id"
					class="link-outline scale-150 hover:rotate-12"
					target="_blank"
					rel="noopener"
					:title="social.title"
					:href="social.link"
					v-html="social.svg"
				/>
				<!--eslint-enable-->
			</div>
			<p className="mt-5 font-bold">
				&copy; The Wordsmith's Collection, LLC 2024
			</p>
			<p>No tracking or ads.</p>
		</footer>
	</div>
</template>
