module.exports = {
    purge: [
        './resources/**/*.html',
        './resources/**/*.vue',
        './resources/**/*.blade.php',
    ],
    darkMode: false, // or 'media' or 'class'
    theme: {
        extend: {
            width: {

            }
        },
        container:{
            width: {

            }
        }
    },
    variants: {
        extend: {},
    },
    corePlugins: {
        container: false
    },
    plugins: [
        function ({ addComponents }) {
            addComponents({
                '.container': {
                    maxWidth: '100%',
                    '@screen sm': {
                        maxWidth: '576px',
                    },
                    '@screen md': {
                        maxWidth: '768px',
                    },
                    '@screen lg': {
                        maxWidth: '992px',
                    },
                    '@screen xl': {
                        maxWidth: '1200px',
                    },
                    '@screen 2xl': {
                        maxWidth: '1400px',
                    },
                }
            })
        }
    ],
}
