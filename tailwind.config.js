import defaultTheme from 'tailwindcss/defaultTheme'
import forms from '@tailwindcss/forms'
const plugin = require('tailwindcss/plugin')
const colors = require('tailwindcss/colors')

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        // './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        // './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        colors:{
            transparent: 'transparent',
            current: 'currentColor',
            black: colors.black,
            white: colors.white,
            gray: colors.gray,
            emerald: colors.emerald,
            indigo: colors.indigo,
            yellow: colors.yellow,
            green: colors.green,
            red: colors.red,
            blue: colors.blue,
            purple: colors.purple,
            orange: colors.orange,
            'cyan': '#57ffff'
        },
        extend: {
			fontFamily: {
				sans: ['Nunito', ...defaultTheme.fontFamily.sans],
			},
        },
        screens: {
            'xs': '360px',

            'sm': '640px',

            'md': '768px',

            'lg': '1024px',

            'xl': '1280px',

            '2xl': '1536px',
        }
    },

    plugins: [
		require('@tailwindcss/forms'),
		require('@tailwindcss/typography'),
		plugin(function({ addBase, theme }){
			addBase({
				'.table': {
					'border-top-width': '1px',
					'border-top-left-radius': '0.5rem',
					'border-top-right-radius': '0.5rem',
					'--tw-border-opacity': '1',
					'border-color': 'rgba(209, 213, 219, var(--tw-border-opacity))'
				},
				'.th_rows': {
					'text-align': 'center',
					'border-bottom-width': '2px',
					'border-color': 'rgba(209, 213, 219, var(--tw-border-opacity))',
					'font-weight': '700',
					'--tw-text-opacity': '1',
					'color': 'rgba(0, 0, 0, var(--tw-text-opacity))'
				},
				'.th':{
					'padding-left': '1rem',
					'padding-right': '1rem',
					'padding-top': '0.75rem',
					'padding-bottom': '0.75rem',
					'text-align': 'center',
				},
				'.tb_rows': {
					'--tw-bg-opacity': '1',
					'background-color': 'rgba(255, 255, 255, var(--tw-bg-opacity))',
					'font-weight': '400',
				},
				'.td': {
					'padding-left': '1rem',
					'padding-right': '1rem',
					'padding-top': '0.75rem',
					'padding-bottom': '0.75rem',
					'border-bottom-width': '1px',
					'--tw-border-opacity': '1',
					'border-color': 'rgba(209, 213, 219, var(--tw-border-opacity))',
					'text-align': 'center',
				}
			})
		})
	],
};