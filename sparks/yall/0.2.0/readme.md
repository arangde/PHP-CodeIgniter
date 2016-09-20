# Y'ALL - Yet Another Layout Library for CodeIgniter

## Requirements

* CodeIgniter 2
* [CodeIgniter Sparks](http://getsparks.org/)

## Setup

1. [Install Sparks](http://getsparks.org/install) if you haven't done so already.
2. Install the Y'ALL spark (see [here](http://getsparks.org/get-sparks) if you don't know how).
3. **Optional:** Set your default layout in `config/yall.php`.
  * Default is `layouts/default`.
  * Depending on what you set, make sure that the files actually exist in your `application/views/` directory. For example, `layouts/default` maps to `application/views/layouts/default.php`.

## Usage

### set($name, $val, $encode = FALSE)

Set a variable to be used in the layout. Setting `$encode = TRUE` will pass the value through `htmlentities()`.

Example: `$this->yall->set('title', 'My Page Title');`

### set_global($name, $val, $encode = FALSE)

Set a variable to be used in the layout _and_ partials (although you must call this **before** setting your partials). Setting `$encode = TRUE` will pass the value through `htmlentities()`.

Example: `$this->yall->set_global('username', 'admin');`

### partial($name, $view, $data = array())

Set a view to be used in the layout as a partial. `$data` is an array of variables to be sent to the view being called.

Example: `$this->yall->partial('main_content', 'users/login');`

### render($layout = '', $return = FALSE)

Renders and outputs the layout. You can override the default layout by setting the `$layout` parameter. If you want to return the rendered view, set `$return = TRUE`.

Example: `$this->yall->render();`

## Other Fun Stuff

Be one of the cool kids and use method chaining:

```php
$this->yall->set('title', 'My Title')
    ->set('meta_description', 'Yay for SEO!', TRUE)
    ->set_global('my_var', 'I will be available in partials, too!')
    ->partial('main_content', 'pages/about', array('foo' => 'bar'))
    ->render();
```