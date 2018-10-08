const path = require('path')
const glob = require('glob')
const webpack = require('webpack')
const UglifyJSPlugin = require('uglifyjs-webpack-plugin');


module.exports = {
  mode: 'production',
	entry: toObject(glob.sync('./public/js/*.es.js'),''),  
	output: {
		path: path.resolve(__dirname,'public/'),
        filename: '[name].module.js',
        chunkFilename: '[chunkhash].module.js'
    },
	plugins: [
      new UglifyJSPlugin(),
    ],
    resolve:{
      extensions: ['.js']
    },
	module: {
		rules: [
            {
                test: /\.js$/,
                include: /public\/js/,
                exclude: /node_modules/,
                use: {
                    loader: "babel-loader",
                    options: {
                        presets: ['env'],
                        plugins: [
                            'syntax-dynamic-import',
                            ["transform-runtime", {
                                "helpers": false,
                                "polyfill": false,
                                "regenerator": true,
                                "moduleName": "babel-runtime"
                              }]
                        ]
                    },
                    
                }    
            }
        ]
    },
    watch: true,
    watchOptions: {
        ignored: /node_modules/
    }
}

function toObject(paths,exclude) {	
  let ret = {};
  paths.forEach(function(path) {
	var a = path.split('/')
	var dir = a.slice(0,a.length-1).join('/')+'/'
	var name = a[a.length-1].split('.')
    ret[dir.replace(exclude,'.') + name.slice(0,name.length-1).join('.')] = path
  })

  return ret
}