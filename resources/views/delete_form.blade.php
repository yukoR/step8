<!-- 消去フォーム -->
<form action="{{ route('product.destroy', $product) }}" method="post">
    @csrf
    @method('delete')
    <button type="submit" class="btn btn-danger btn-sm text-nowrap" id="btnDeleteButton" onclick="return confirm('本当に削除しますか')">削除</button>
</form>
