// plugins
const {CleanWebpackPlugin} = require('clean-webpack-plugin');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const OptimizeCssAssetsPlugin = require('optimize-css-assets-webpack-plugin');
const TerserWebpackPlugin = require('terser-webpack-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const Webpack = require('webpack');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const util = require("./util/webpack-config.utilities");

// path handling
const path = require('path');
const {resolve} = require('path');
const srcPath = resolve(__dirname, 'src');
const buildPath = resolve(__dirname, 'dist');
const pagesPath = resolve(__dirname, 'src/pages/');

module.exports = async () => {
    return new Promise(async (resolve, reject) => {

        const pages = await util.readPages(path.resolve(pagesPath));
        const entries = await util.buildEntries(pages);
        const htmlWebpackPlugins = await util.buildHtmlWebpackPlugins(pages);

        resolve({
                mode: "development",

                resolve: {
                    alias: {
                        assets: path.resolve(__dirname, 'src/assets')
                    }
                },

                entry: {
                    index: path.resolve(srcPath, 'index.js'),
                    ...entries
                },

                output: {
                    filename: (chunkData) => {
                        return chunkData.chunk.name === 'index' ? 'assets/js/[name].js' : `assets/js/templates/${util.camelToKebabCase(chunkData.chunk.name)}.js`;
                    },
                    path: buildPath
                },

                module: {
                    rules: [
                        {
                            test: /\.js$/,
                            exclude: /node_modules/,
                            loader: 'babel-loader',
                            options: {
                                presets: ['@babel/preset-env']
                            }
                        },
                        {
                            test: /\.(scss)$/,
                            use: [
                                MiniCssExtractPlugin.loader,
                                'css-loader',
                                {
                                    loader: 'postcss-loader', // Run post css actions
                                    options: {
                                        plugins: function () { // post css plugins, can be exported to postcss.config.js
                                            return [
                                                require('precss'),
                                                require('autoprefixer')
                                            ];
                                        }
                                    }
                                },
                                {
                                    loader: 'sass-loader', // compiles Sass to CSS
                                }
                            ]
                        },
                        {
                            test: /\.(css)$/,
                            use: [
                                MiniCssExtractPlugin.loader,
                                'css-loader',
                            ]
                        },
                        {
                            test: /\.(svg|woff|woff2|eot|ttf|png)$/i,
                            loader: 'file-loader',
                            options: {
                                name: '[path][name].[ext]',
                                context: 'src'
                            }
                        },
                    ],
                },

                devServer: {
                    contentBase: buildPath,
                    compress: true,
                    port: 9000,
                    watchContentBase: true
                },

                plugins: [

                    new CleanWebpackPlugin(),

                    new HtmlWebpackPlugin(
                        {
                            template: path.resolve(__dirname, `src/pages/startseite/startseite.html`),
                            inject: true,
                            chunks: ['index', 'startseite'],
                            filename: `index.html`,
                            title: `Template für die Startseite`
                        }
                    ),

                    ...htmlWebpackPlugins,

                    new MiniCssExtractPlugin({
                        moduleFilename: ({name}) => {
                            return name === 'index' ? 'assets/css/[name].css' : `assets/css/templates/${util.camelToKebabCase(name)}.css`;
                        },
                        chunkFilename: "[id].css"
                    }),

                    new CopyWebpackPlugin([
                        {
                            from: path.resolve(__dirname, 'src/assets/img'),
                            to: path.resolve(__dirname, 'dist/assets/img')
                        },
                    ]),

                    new Webpack.ProvidePlugin({
                        $: 'jquery',
                        jQuery: 'jquery'
                    })
                ],

                optimization: {
                    minimizer: [

                        new TerserWebpackPlugin({
                            cache: true,
                            parallel: true,
                            sourceMap: true
                        }),

                        new OptimizeCssAssetsPlugin()
                    ]
                }
            }
        );
    });
};
