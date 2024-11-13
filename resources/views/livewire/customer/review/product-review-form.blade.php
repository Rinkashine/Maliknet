<div>
    <div wire:ignore.self  id="review-product-modal" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="w-full h-full bg-white rounded">
                <div class="px-5 py-10 modal-body">
                    <div>
                        <h1 class="text-xl">Product Review</h1>
                        <div class="p-5 mt-5 box">
                            <div>

                            </div>
                            <div>
                                Order ID:{{ $orderDetails->id }}
                            </div>
                            <div>
                                Placed On: {{ $orderDetails->created_at->toFormattedDateString() }}
                            </div>
                            <div>
                                Mode of Payment: {{ $orderDetails->mode_of_payment }}
                            </div>
                        </div>
                        <form wire:submit.prevent="CreateReview">
                            <div class="w-full mt-2">
                                <div class="flex justify-center w-full h-10 gap-5 mb-5 rating space">
                                    <i class="text-xl text-yellow-300 hover:text-2xl rating__star fas fa-star" wire:click="setRate(1)"></i>
                                    <i class="text-xl text-yellow-300 hover:text-2xl rating__star far fa-star" wire:click="setRate(2)"></i>
                                    <i class="text-xl text-yellow-300 hover:text-2xl rating__star far fa-star" wire:click="setRate(3)"></i>
                                    <i class="text-xl text-yellow-300 hover:text-2xl rating__star far fa-star" wire:click="setRate(4)"></i>
                                    <i class="text-xl text-yellow-300 hover:text-2xl rating__star far fa-star" wire:click="setRate(5)"></i>
                                </div>
                                <div>
                                    @csrf
                                    <input type="number" id="rate-input" wire:model.lazy="rate" name="rate" class="hidden">
                                    <textarea wire:model.lazy="comment" id="editor" class="form-control w-full h-32 resize-none" name="comment" placeholder="Write your review." ></textarea>
                                </div>
                                <div class="w-full mt-2 text-danger">@error('comment'){{$message}}@enderror</div>
                            </div>
                            <div class="flex gap-2">
                                <button type="submit" class="w-24 btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            const activeStarClass = 'rating__star text-yellow-300 hover:text-2xl fas fa-star text-xl'
            const noFillStar =  'rating__star text-yellow-300 hover:text-2xl far fa-star text-xl'
            const rateInput = document.querySelector("#rate-input")
            const stars = document.querySelectorAll(".rating__star")
            const setRate = (rating)=>{
                stars.forEach((star, index)=>{
                    if(index <= (rating - 1)){
                        star.className = activeStarClass
                    }
                    else{
                        star.className = noFillStar
                    }
                })
            }
            window.addEventListener('RenderRating', event => {
                setRate(event.detail.rate)
            });
        </script>
    @endpush
</div>
