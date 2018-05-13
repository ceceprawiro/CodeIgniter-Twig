Twig - Twig template engine implementation for CodeIgniter
================

Twig template engine implementation for CodeIgniter.
Modified from [codeigniter-twiggy](https://github.com/edmundask/codeigniter-twiggy).

# How To Use It

## 1. Set up dir structure

1. Create a directory structure:

    ```
    +-{APPPATH}/
    | +-themes/
    | | +-default/
    | | | +-_layouts/
    ```

    NOTE: `{APPPATH}` is the folder where all your controllers, models and other neat stuff is placed.
    By default that folder is called `application`.

2. Create a default layout `index.html.twig` and place it in _layouts  folder:

    ```
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
            <![endif]-->
            <title>Default layout</title>
        </head>
        <body>

            {% block content %}{% endblock %}

        </body>
    </html>
    ```

3. Create a default template file `index.html.twig` at the root of `default` theme folder:

    ```
    {% extends _layout %}

    {% block content %}

        Default template file.

    {% endblock %}
    ```

4. You should end up with a structure like this:

    ```
    +-{APPPATH}/
    | +-themes/
    | | +-default/
    | | | +-_layouts/
    | | | | +-index.twig
    | | | +-index.twig
    ```

## 2. Display the template

`$this->twig->display();`

# COPYRIGHT

Copyright (c) 2018 Cecep Prawiro

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
