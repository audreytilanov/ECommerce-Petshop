<div>
    <div class="basic-form">
        <form wire:submit.prevent="save" method="post">
            @csrf
            <div class="form-group">
                <label>Nama Product</label>
                <input type="text" class="form-control" placeholder="Ex. Whiskas Tuna" value="{{ old('product_name') }}" name="product_name" required>
                @error('product_name')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            <div class="form-group">
                <label>Harga</label>
                <input type="number" class="form-control" placeholder="Ex. 50000" value="{{ old('price') }}" name="price" required>
                @error('price')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>  
            <div class="form-group">
                <label>Deskripsi</label>
                <div class="col-lg-12">
                    <textarea name="description" style="width:100%" id="description" rows="4" required>{{ old('description') }}</textarea>
                </div>
                @error('description')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>  
            <div class="form-group">
                <label>Stok</label>
                <input type="number" class="form-control" placeholder="Ex. 10" value="{{ old('stock') }}" name="stock" required>
                @error('stock')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>  
            <div class="form-group">
                <label>Berat</label>
                <input type="text" class="form-control" placeholder="Ex. 1 Kg" value="{{ old('weight') }}" name="weight" required>
                @error('weight')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>  
            <section id="main-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="bootstrap-data-table-panel">
                                <div class="table-responsive">
                                    <a wire:click.prevent="tambahImage">
                                        <div class="btn btn-primary">Tambah</div>
                                    </a>
                                    <table id="" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Product Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($image as $index => $images)
                                            <tr>
                                                <td>
                                                    <input type="file"
                                                            name="image[{{$index}}]"
                                                            class="form-control"
                                                            wire:model="image.{{$index}}" required />
                                                </td>
                                                <td>
                                                    <a class="btn btn-danger" href="#" wire:click.prevent="deleteImage({{$index}})">Delete</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /# card -->
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
            </section>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
