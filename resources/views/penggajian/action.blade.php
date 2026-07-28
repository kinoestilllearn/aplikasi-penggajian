<div class="inline-flex items-center gap-1">
    <a href="{{ route('penggajian.show', $penggajian->id) }}"
       class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 hover:bg-indigo-600 hover:text-white transition-colors shadow-sm"
       title="Lihat Detail / Slip Gaji">
        <i data-lucide="eye" class="w-4 h-4"></i>
    </a>
    @can('penggajian-delete')
    {{ html()->form('DELETE', route('penggajian.destroy', $penggajian->id))->id('delete-penggajian-' . $penggajian->id)->class('inline')->open() }}
    <button type="button" onclick="confirmDeletePenggajian({{ $penggajian->id }})"
            class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white transition-colors shadow-sm"
            title="Hapus Transaksi">
        <i data-lucide="trash-2" class="w-4 h-4"></i>
    </button>
    {{ html()->form()->close() }}
    @endcan
</div>

<script>
    if (typeof confirmDeletePenggajian === 'undefined') {
        function confirmDeletePenggajian(id) {
            if (confirm("Apakah Anda yakin akan menghapus data penggajian ini?")) {
                document.getElementById('delete-penggajian-' + id).submit();
            }
        }
    }
</script>