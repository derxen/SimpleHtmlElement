# SimpleHtmlElement

Handle HTML elements as an object with optional nodes

## Installation

### Composer

You can use SimpleHtmlElement by putting the following line into your composer.json

```
    {
        "require": {
            "derxen/simple-html-element": "~1.0"
        }
    }
```

And make sure you load the class within you PHP code or use the Composer Autoloader

## Documentation

SimpleHtmlElement has been made to make your work easier. Here is an example:

Create html root.
```
$html       = new derxen\SimpleHtmlElement();
```

We define some table headers.
```
$headers    = ['publish date', 'title', 'author'];
```

We fetch some table data.
```
$data       = [];
$data[]     = ['05-03-2016', 'A great book', 'Sam Wilson'];
$data[]     = ['08-04-2016', 'Another great book', 'Jane Fisscher'];
$data[]     = ['11-01-2016', 'The greatest book', 'Dan Morris'];
```

Let us create a new table.
``If you give an array as property, SimpleHtmlElement will handle the property as attributes``

```
$table      = $html->table(['method' => 'post']);
```

Now we add the table headers.
```
foreach($headers as $th) {
    $table->th($th);
}
```

Now we add the table rows with content.
``If you give a string as property, SimpleHtmlElement will handle the property as content``

```
foreach($data as $cols) {
    $tr = $table->tr();
    foreach($cols as $td) {
        $tr->td($td);
    }
}
```

We could set some extra attributes to the table.
```
$table->setAttribute(['action' => '/handleform']);
```


Our table is ready. Now we render the table
```
echo $table->write();
```

Or We can just do:
```
echo $table;
```