<table>
    @foreach($products as $product)
    <tr>
        <td>{{ $product->name }}</td>
        <td>{{ number_format($product->price) }} VNĐ</td>
        <td>{{ $product->categories->name }}</td> <!-- Nhờ có Relationship trong Model mới gọi được thế này -->
        <td><img src="{{ asset('storage/'.$product->picture) }}" width="50"></td>
    </tr>
    @endforeach
</table>