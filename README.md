# Bokka WordPress Utilities

Intended to provide global utilities for themes and plugins. Intended to be used with the Bokka WP Theme and Bokka MVC plugin. This plugin should be run from the `mu-plugins` folder. For more information on must use plugins see the [WordPress Codex](https://codex.wordpress.org/Must_Use_Plugins).

## Usage

You can make use of these functions by calling the class methods namespaced with `BokkaWP\Utilities\{Class Name}`.

Example: 
`BokkaWP\Utilities\Video::get_embed_url($url)`


## Constants

Several global variables are created by this plugin and can be used through other plugins as well as the Bokka theme.

### Plugin variables

* `BOKKA_UTILITIES_DIRECTORY` is the path to the directory for this plugin

### Theme variables

* `BOKKA_PARENT_DIR` is the path to the Bokka parent WP theme

* `BOKKA_CHILD_DIR` is the path to the Bokka child WP theme

### Environment variables

* `BOKKA_ENV` has 3 possible values - `local`, `staging`, and `production`

## Available Methods

Need to detail out the available methods here.

## TODO

* Constants class (singleton)
    * Environment, theme, plugins
