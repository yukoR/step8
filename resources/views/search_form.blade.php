<!-- 検索フォーム -->
<div class="row mt-4 mb-4">
    <form action="{{ route('search') }}" method="post" class="row">
        @csrf
        <div class="col">
            <input type="text" class="form-control" name="search" placeholder="検索キーワード" value="{{ request('search') }}">
        </div>
        <div class="col">
            <select name="companyId" class="form-control">
                <option value="0">企業を選択してください</option>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-secondary">検索</button>
        </div>
    </form>
</div>
