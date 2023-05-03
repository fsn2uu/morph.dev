<div>
    @php
        $toasts = session()->get('toasts');
    @endphp
    
    <style>
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            width: 300px;
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 10px;
            opacity: 0;
            transform: translateX(100%);
            transition: opacity 0.3s ease-out, transform 0.3s ease-out;
            }

            .toast.show {
            opacity: 1;
            transform: translateX(0);
            }

            .toast-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-bottom: 5px;
            border-bottom: 1px solid #ccc;
            margin-bottom: 5px;
            }

            .toast-body {
            color: #555;
            }

            .toast .close {
            font-size: 1.2rem;
            color: #aaa;
            cursor: pointer;
            }

            .toast .close:hover {
            color: #777;
            }

    </style>

    @if ($toasts)
        @foreach ($toasts as $toast)
            <div class="toast">
                <div class="toast-header">
                    <strong class="mr-auto">{{ $toast['title'] }}</strong>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body">
                    {{ $toast['message'] }}
                </div>
            </div>
        @endforeach
    @endif
</div>

@push('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var closeButtons = document.querySelectorAll('.toast .close');
        
        closeButtons.forEach(function(button) {
            button.addEventListener('click', function() {
            var toast = this.closest('.toast');
            toast.style.display = 'none';
            });
        });
    });

</script>
    
@endpush