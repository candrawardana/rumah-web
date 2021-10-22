<div class="input-field">
      <select id="selectsantri" name="santri[]" multiple>
            <option value="" disabled></option>
            @foreach(list_santri() as $s)
            <option value="{{ $s->s_nis }}">{{ $s->s_nama }}</option>
            @endforeach
      </select>
      <label for="selectsantri">Pilih Santri</label>
</div>