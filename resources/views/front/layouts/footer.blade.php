</div>
</div>



</main>

<footer class="py-5 bg-dark text-white text-center">
    <div class="container">
        <div class="col">
            <h4 class="text-uppercase"></h4>
            @php $socials = ['facebook', 'twitter', 'github', 'linkedin', 'youtube', 'instagram'];
            @endphp
            @foreach ($socials as $social)
                @if ($config->$social != null)
                    <a href="{{ $config->$social }}" target="_blank">
                        <button class="btn btn-outline btn-social">
                            <i class="fab fa-fw fa-{{ $social }}"></i>
                        </button>
                    </a>
                @endif
            @endforeach
        </div>
        <br>
        <div class="row">

            <div class="col-lg-12">
                <div class="copyright-text">
                    <p>Copyright &copy; {{ date('Y') }} - {{ $config->title }}

                        | <a rel="nofollow" href="{{ route('admin.login') }}" target="_blank">Admin Panel</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>

</html>
