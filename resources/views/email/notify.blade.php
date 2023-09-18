<!DOCTYPE html>
<html>
<head>
    <title>The product is purchased</title>
</head>
<body>
Hi {{ $user }}!

You have successfully purchased product from our shop.

<h1>{{ $product->name }}</h1>
<p>
    Price: {{ $product->price }}
</p>

</body>
</html>
