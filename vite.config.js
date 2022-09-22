import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'
import Components from 'unplugin-vue-components/vite'


export default defineConfig({
    plugins: [
        vue(),
        laravel([
            'resources/css/app.css',
            'resources/js/app.js',
        ]),
        Components({
            // relative paths to the directory to search for components.
            dirs: ['resources/js/components/layouts'],
          
            // valid file extensions for components.
            extensions: ['vue'],
            // search for subdirectories
            deep: true,
            // resolvers for custom components
            resolvers: [
                // (name) => {
                //     console.log(name, 'name')
                // //   if (name.startsWith('Layout')) {
                //     return { name: `${name}`, from: '@/' };
                // //   }
                // },
            ],
          
            // generate `components.d.ts` global declarations,
            // also accepts a path for custom filename
            // default: `true` if package typescript is installed
            dts: false,
          
            // Allow subdirectories as namespace prefix for components.
            directoryAsNamespace: false,
            // Subdirectory paths for ignoring namespace prefixes
            // works when `directoryAsNamespace: true`
            globalNamespaces: [],
          
            // auto import for directives
            // default: `true` for Vue 3, `false` for Vue 2
            // Babel is needed to do the transformation for Vue 2, it's disabled by default for performance concerns.
            // To install Babel, run: `npm install -D @babel/parser`
            directives: true,
          
            // Transform path before resolving
            importPathTransform: v => v,
          
            // Allow for components to override other components with the same name
            allowOverrides: false,
          
            // filters for transforming targets
            include: [/\.vue$/, /\.vue\?vue/],
            exclude: [/[\\/]node_modules[\\/]/, /[\\/]\.git[\\/]/, /[\\/]\.nuxt[\\/]/],
        })
    ],
});