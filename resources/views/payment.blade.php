@extends('layouts.main')

@section('content')

<style>
    /* Add your styles here */
    .hidden {
      display: none;
    }
  </style>

<div class="p-10 px-20">
    <div class="">
        <div class="my-5 object-cover">
            
            <img src="{{ asset('default-img/event_image.jpg') }}" alt="Default Event Image" class="w-full h-full object-cover">
            
        </div>
    </div>
    <div class="">
        <div class="bg-white p-8 rounded-lg shadow-md space-y-6">
    

<form action="{{ route('payments.store', ['booking' => $booking]) }}" method="POST" enctype="multipart/form-data" >
      @csrf
        <div>
          <p class="text-xl mb-4">Select a Duration:</p>
          <div>
            <label for="amount" class="inline-flex items-center mr-6">
              <input type="radio" class="form-radio text-indigo-600" name="amount" id="amount" value="700" onclick="updateTotalAmount(this.value)">
              <span class="ml-2">Half Day | Price: 700 THB</span>
            </label>
            <label for="amount" class="inline-flex items-center">
              <input type="radio" class="form-radio text-indigo-600" name="amount" id="amount" value="1,400" onclick="updateTotalAmount(this.value)">
              <span class="ml-2">Full Day | Price: 1,400 THB</span>
            </label>
          </div>
        </div>

        
        <div>
          <p class="text-xl mb-4 mt-4">Select a Payment Method:</p>
          <div>
            <label for="payment" class="inline-flex items-center mr-6">
              <input type="radio" class="form-radio text-indigo-600" name="payment_method" id="transfer" value="transfer" onclick="showContent('transfer')">
              <span class="ml-2">Transfer</span>
            </label>
            <label for="payment" class="inline-flex items-center">
              <input type="radio" class="form-radio text-indigo-600" name="payment_method" id="cash" value="cash" onclick="showContent('cash')">
              <span class="ml-2">Cash</span>
            </label>
            <div>
            <p id="totalAmount" class="text-xl mb-4 mt-4">Total Amount: </p>
          <div>
            <div id="transferContent" class="hidden">
              <div>
                </div>
                  <p class="text-xl mt-10 ml-12">Scan Here</p>
                  <img class="object-cover w-48 h-44 mt-10" src="{{ asset('default-img/qrcode.jpg') }}" alt="">
                  <div class="flex flex-col  p-3">
                        <label for="image_path" class="pb-3">Add Images</label>
                        <input type="file" name="image_path" id="image_path" class="h-64 w-full hover:opacity-80 rounded-lg cursor-pointer border-yellow-200">
                        @error('image_path')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex mt-3 mb-5">
                        <div class="flex items-center w-1/2 pl-3">
                            <label for="P_date" class="pr-3">Pay Date
                            </label>
                            <input type="date" name="P_date" id="P_date">
                            @error('P_date')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                        </div>
                </div>
            </div>
            <div id="cashContent" class="hidden">
            <div class="flex mt-3 mb-5">
                        <div class="flex items-center w-1/2 pl-3">
                            <label for="P_date" class="pr-3">Pickup Car Date
                            </label>
                            <input type="date" name="P_date" id="P_date">
                            @error('P_date')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                        </div>
                      <div>
                  </div>
                </div>
              </div>

              <button type="submit" onclick="return confirm('Are you sure you want to apply booking?')"
                        class="bg-[#F6D106] p-1 pl-5 pr-5 mr-5 rounded transition-all hover:opacity-80">
                        apply for pay
              </button>
  </form>

  <script>
  function showContent(paymentType) {
    // Hide all content first
    document.getElementById('transferContent').classList.add('hidden');
    document.getElementById('cashContent').classList.add('hidden');

    // Show the selected content
    document.getElementById(paymentType + 'Content').classList.remove('hidden');
  }

  function updateTotalAmount(value) {
    // Display the selected value in the "Total Amount" paragraph
    document.getElementById('totalAmount').textContent = 'Total Amount: ' + value + ' THB';
  }
</script> 
@endsection