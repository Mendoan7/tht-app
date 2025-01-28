<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Kategori Produk</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
            <th>Stok</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $index => $product)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name }}</td>
                <td>{{ $product->buy_price }}</td>
                <td>{{ $product->sell_price }}</td>
                <td>{{ $product->stock }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
