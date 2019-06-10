# Buzina Pagination
Simple leightweight [jQuery](https://jquery.com) pagination. Uses [Bootstrap](getbootstrap.com) pager structure, but also perfectly works without any frontend framework.

#### Install
Download buzina-pagination.min.css and buzina-pagination.min.js into your site directory, put the stylesheet and script tags into your code:

```
<link rel="stylesheet" href="/buzina-pagination.min.css" />
```
```
<script src="/buzina-pagination.min.js"></script>
```

#### Usage
Paginated element must have the following structure:
```
<div id="uniqueId">
  <div>Lorem ipsum dolor sit amet.</div>
  <div>Consectetur adipisicing elit ea assumenda.</div>
  <div>Quibusdam cum quod quisquam excepturi.</div>
  <div>Tempore, et? Explicabo dolore id.</div>
  <div>Quibusdam deleniti saepe sequi illo porro!</div>
</div>
```
Where `uniqueId` is your unique id for this element.

Add this code at the bottom of your markup to activate the plugin:
```
<script>
  $(document).ready(function () {
    $('#uniqueId').buzinaPagination();
  });
</script>
```
#### Options
|Name|Default|Description
---|---|---
`prevnext`|`true`|
`prevText`|`"Previous"`|
`nextText`|`"Next"`|
`itemsOnPage`|`1`|

Example:
```
<script>
  $(document).ready(function () {
    $('#uniqueId').buzinaPagination({
      prevnext: false,
      itemsOnPage: 5
    });
  });
</script>
```

#### TODO
* Add Bootstrap `.active` and `.disabled` calsses.

## License
The code and the documentation are released under the [MIT License](https://github.com/mikebrsv/buzina-pagination/blob/master/LICENSE).