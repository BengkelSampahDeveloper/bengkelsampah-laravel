{{-- @if($artikels->count() > 0)
    <tbody>
        @foreach($artikels as $artikel)
            <tr>
                <td>
                    <input type="checkbox" class="article-checkbox" value="{{ $artikel->id }}">
                </td>
                <td>
                    <div class="article-image">
                        <img src="{{ asset($artikel->cover) }}" alt="{{ $artikel->title }}">
                    </div>
                </td>
                <td>
                    <div class="article-info">
                        <h3>{{ $artikel->title }}</h3>
                        <p>{{ Str::limit(strip_tags($artikel->content), 200) }}</p>
                    </div>
                </td>
                <td>{{ $artikel->kategori->nama ?? '-' }}</td>
                <td>{{ $artikel->creator }}</td>
                <td>{{ $artikel->created_at->format('d M Y H:i') }}</td>
                <td>
                    <div class="action-buttons">
                        <button class="edit-button" data-id="{{ $artikel->id }}">
                            <img src="{{ asset('icon/ic_edit.svg') }}" alt="Edit">
                        </button>
                        <button class="delete-button" data-id="{{ $artikel->id }}">
                            <img src="{{ asset('icon/ic_delete.svg') }}" alt="Delete">
                        </button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
@else
    <tbody>
        <tr>
            <td colspan="7" class="no-results">Tidak ada data yang ditemukan</td>
        </tr>
    </tbody>
@endif  --}}