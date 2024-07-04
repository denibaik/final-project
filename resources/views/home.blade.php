<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ORCSECOND</title>

    <!-- FOnts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />

    <!-- feather icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- My style -->

    <link rel="stylesheet" href="/css/style.css" />

    <!-- alpine js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="/src/app.js"></script>
</head>

<body>
    <!-- Navbar start -->

    <nav class="navbar" x-data>
        <a href="#" class="navbar-logo">ORC<span>SECOND</span>.</a>

        @if (Request::has('search'))
            <div class="navbar-nav">
                <a href="{{ route('home') }}#home">Home</a>
                <a href="{{ route('home') }}#about">Tentang Kami</a>
                <a href="{{ route('home') }}#catalog">Catalog</a>
                <a href="{{ route('home') }}#products">Sale</a>
                <a href="{{ route('home') }}#contact">Kontak</a>
            </div>
        @else
            <div class="navbar-nav">
                <a href="#home">Home</a>
                <a href="#about">Tentang Kami</a>
                <a href="#catalog">Catalog</a>
                <a href="#products">Sale</a>
                <a href="#contact">Kontak</a>
            </div>
        @endif

        <div class="navbar-extra">
            <a href="#" id="search-button" style="margin-right: 16px;"><i data-feather="search"></i></a>
            @if (Auth::check())
                <a
                    href="@if (Auth::user()->role !== 'Admin') javascript:void(0)@else{{ route('admin') }} @endif">{{ Auth::user()->name }}</a>
                <a href="{{ route('logout') }}" style="margin-left: 16px;"><i data-feather="log-out"></i></a>
            @else
                <a href="#"><i data-feather="log-in"></i></a>
            @endif
            {{-- <a href="#" id="shopping-cart-button"><i data-feather="shopping-cart"></i>
                <span class="quantity-badge" x-show="$store.cart.quantity" x-text="$store.cart.quantity"></span>
            </a> --}}
            <a href="#" id="hamburger-menu"><i data-feather="menu"></i></a>
        </div>

        <!-- Search Form start -->
        <div class="search-form">
            <form action="" method="get">
                <input type="search" name="search" id="search-box" placeholder="Ketik kemudian enter..." />
                {{-- <label for="search-box"><i data-feather="search"></i></label> --}}
            </form>
        </div>
        <!-- Search Form end -->

        <!-- Shopping Cart start -->
        <div class="shopping-cart">
            <template x-for="(item, index) in $store.cart.items" x-key="index">
                <div class="cart-item">
                    <img :src="`/img/sale/${item.img}`" :alt="item.name" />
                    <div class="item-detail">
                        <h3 x-text="item.name"></h3>
                        <div class="item-price">
                            <span x-text="rupiah(item.price)"></span> &times;
                            <button id="remove" @click="$store.cart.remove(item.id)">
                                &minus;
                            </button>
                            <span x-text="item.quantity"></span>
                            <button id="add" @click="$store.cart.add(item)">&plus;</button>
                            &equals;
                            <span x-text="rupiah(item.total)"></span>
                        </div>
                    </div>
                </div>
            </template>
            <h4 x-show="!$store.cart.items.length">Cart Is Empty</h4>
            <h4 x-show="$store.cart.items.length">
                Total : <span x-text="rupah($store.cart.total)"></span>
            </h4>
        </div>
        <!-- Shopping Cart end -->
    </nav>

    <!-- Navbar end -->

    @if (!$search)
        <!-- hero section start-->
        <section class="hero" id="home">
            <main class="content">
                <h1>Start thrifting defend <span>Earth</span></h1>
                <p>
                    Ready Stock beragam pakaian import branded dengan kualitas istimewa
                </p>
                <a href="#products" class="cta">Lets go</a>
            </main>
        </section>
        <!-- hero section end-->

        <!-- about section start -->
        <section id="about" class="about">
            <h2><span>Tentang</span> Kami</h2>

            <div class="row">
                <div class="about-img">
                    <img src="img/tentang-kami.jpg" alt="Tentang Kami" />
                </div>
                <div class="content">
                    <h3>Kenapa memilih kami?</h3>
                    <p>
                        ORCSECOND adalah sebuah toko pakaian bekas import yang berada di
                        Yogyakarta. Toko kami memiliki barang dengan kualitas yang tak kalah
                        dengan pakaian baru. Barang barang disini telah disortir dengan baik
                        sehingga banyak barang barang branded yang masih kelihatan sepeti
                        baru. Berbagai macam pakaian branded seperti adidas, nike, puma, dll
                        dengan harga yang terjangkau kami sediakan untuk memenuhi kebutuhan
                        fashion kawula muda khususnya yang ada di Yogyakarta. Tak hanya
                        pakaian saja kami juga menyediakan topi dan sepatu branded dengan
                        kualitas ORIGINAL 100%.
                    </p>
                    <p>
                        Selain itu pakaian disini sudah dilaundry dengan bersih serta wangi
                        sehingga pembeli bisa langsung memakainya tanpa perlu takut bau
                        ataupun gatal. Untuk transaksi pembeli bisa menggunakan direct
                        payment bank ataupun melalui platfrom jual beli online seperti
                        shoope, tokopedia dll sehingga semua transaksi disini dijamin aman
                        100%.
                    </p>
                </div>
            </div>
        </section>
        <!-- about section end -->
    @endif

    <!-- catalog section start -->

    <section id="catalog" class="catalog">
        <h2><span>Catalog</span> kami</h2>
        <p>klik untuk melihat produk</p>
        <div class="row">
            @forelse ($categories as $item)
                <div class="catalog-card">
                    <a href="{{ route('home', ['search' => urlencode($item->name)]) }}" style="color: #fff">
                        <img src="{{ asset('img/' . $item->image) }}" class="catalog-card-img" />
                        <h3 class="catalog-card-title">{{ $item->name }}</h3>
                        <p class="catalog-card-price">{{ $item->description }}</p>
                    </a>
                </div>
            @empty
                <div class="text-center">
                    <div class="alert alert-warning">Data Tidak Tersedia</div>
                </div>
            @endforelse

        </div>
    </section>
    <!-- catalog section end -->

    <!-- Products Section start -->
    <section class="products" id="products" x-data="products">
        @if (!empty($products))
            <h2><span>Ready</span> Stock {{ urldecode(Request::get('search')) }}</h2>
            <p>Item Kita yang ready stock sebagai berikut</p>
        @else
            <h2><span>Stock</span> {{ urldecode(Request::get('search')) }} Kosong</h2>
        @endif

        <div class="row">
            @forelse ($products as $item)
                <a href="javascript:void(0)" onclick="bukaModal({{ $item->id }})" style="color: #fff">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="{{ asset('img/sale/' . $item->image) }}" />
                        </div>
                        <div class="product-content">
                            <h3>{{ $item->name }}</h3>
                            <div class="product-price">
                                <span>Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="text-center" style="height: 100%;">
                    <div class="alert alert-warning">Produk Belum Tersedia</div>
                </div>
            @endforelse
        </div>
    </section>
    <!-- Products Section end -->

    @if (!$search)
        <!-- contact section start -->
        <section id="contact" class="contact">
            <h2><span>Kontak</span> Kami</h2>
            <p>Jika Ada Pertanyaan Lebih Bisa Tanyakan Ke Kami</p>

            <div class="row">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63245.984386631586!2d110.30102327265436!3d-7.803159008583969!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5787bd5b6bc5%3A0x21723fd4d3684f71!2sYogyakarta%2C%20Kota%20Yogyakarta%2C%20Daerah%20Istimewa%20Yogyakarta!5e0!3m2!1sid!2sid!4v1715870211672!5m2!1sid!2sid"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                    class="map"></iframe>

                <form id="whatsappForm">
                    <div class="input-group">
                        <i data-feather="user"></i>
                        <input type="text" id="name" placeholder="nama" required />
                    </div>
                    <div class="input-group">
                        <i data-feather="phone"></i>
                        <input type="text" id="phone" placeholder="no hp" required />
                    </div>
                    <div class="input-group">
                        <i data-feather="mail"></i>
                        <input type="text" id="message" placeholder="send message" required />
                    </div>
                    <button type="submit" class="btn">Kirim Pesan</button>
                </form>
            </div>
        </section>
        <!-- contact section end -->
    @endif

    <!-- footer start -->
    <footer>
        <div class="social">
            <a href="#"><i data-feather="instagram"></i></a>
            <a href="#"><i data-feather="twitter"></i></a>
            <a href="#"><i data-feather="facebook"></i></a>
        </div>

        <div class="link">
            <a href="#home">Home</a>
            <a href="#about">Tentang kami</a>
            <a href="#catalog">Catalog</a>
            <a href="#contact">Kontak</a>
        </div>

        <div class="credit">
            <p>
                Created by <a href="">Kelompok Penerbang Rocket</a>. | &copy; 2024.
            </p>
        </div>
    </footer>
    <!-- footer end -->

    <!-- Modal Box Item Detail start -->
    <div class="modal" id="item-detail-modal">
        <div class="modal-container">
            <a href="javascript:void(0)" onclick="hideModal()" class="close-icon"><i data-feather="x"></i></a>
            <div class="modal-content">
                <img src="" id="modal-img" />
                <div class="product-content">
                    <h3 id="modal-name"></h3>
                    <div id="modal-desc">
                    </div>
                    <div class="product-price" id="modal-price"></div>
                    <br>
                    <br>
                    <label for="">Detail Pengiriman : </label>
                    <form action="{{ route('beli') }}" method="post">
                        @csrf
                        @if (Auth::check())
                        <input type="hidden" name="product_id" value="" id="modal-id">
                        <label for="">Nama : </label>
                        <input type="text" name="" id="" readonly
                            value="{{ Auth::user()->name }}">
                        <br>
                        <label for="">Email : </label>
                        <input type="text" name="" id="" value="{{ Auth::user()->email }}"
                            readonly>
                        <br>
                        <label for="">Alamat : </label>
                        <input type="text" name="" id=""
                            value="{{ Auth::user()->alamat ?? 'kosong' }}" readonly>
                        <br><br>
                        @endif
                        @if (Auth::check())
                            @if (Auth::user()->role == 'Admin')
                                <button type="button" disabled
                                    style="padding: 8px 16px;border-radius: 15px;background-color: #b6895b; color:#fff;"><i
                                        data-feather="danger"></i> KAMU LOGIN SEBAGAI ADMIN!</button>
                            @else
                                <button type="submit"
                                    style="padding: 8px 16px;border-radius: 15px;background-color: #b6895b; color:#fff;cursor: pointer;"><i
                                        data-feather="shopping-cart"></i> Beli Sekarang</button>
                            @endif
                        @else
                            <a href="{{ route('login') }}"
                                style="padding: 8px 16px;border-radius: 15px;background-color: #b6895b; color:#fff;"><i
                                    data-feather="user"></i> Login untuk beli</a>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Box Item Detail end -->

    <!-- feather icons -->
    @include('sweetalert2')

    <script>
        feather.replace();

        document.getElementById('whatsappForm').addEventListener('submit', function(event) {
            event.preventDefault();

            var name = document.getElementById('name').value;
            var phone = document.getElementById('phone').value;
            var message = document.getElementById('message').value;

            var whatsappURL =
                `https://wa.me/628884170395?text=Name:%20${encodeURIComponent(name)}%0A%0A${encodeURIComponent(message)}`;
            window.location.href = whatsappURL;
        });

        function bukaModal(id) {
            $.ajax({
                url: "{{ route('get_produk') }}", // Endpoint untuk mendapatkan data produk
                type: 'GET',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    console.log('Products:', data);
                    if (data !== null) {
                        $('#modal-img').attr('src', "{{ asset('img/sale/') }}/" + data.image);
                        $('#modal-name').html(data.name);
                        $('#modal-id').val(data.id);
                        $('#modal-desc').html(data.description);
                        $('#modal-price').html(rupiah(data.price));
                        $('#item-detail-modal').show();
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error fetching products:', textStatus, errorThrown);
                }
            });
        }

        function hideModal() {
            $('#item-detail-modal').hide();
        }
    </script>

    <!-- javascript -->
    <script src="/js/script.js"></script>
</body>

</html>
