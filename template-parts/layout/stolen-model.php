<div id="modal" class="modal">
  <div class="modal-content !max-w-[590px] p-[25px]">
    <span class="close">&times;</span>
    <h2 class="text-[34px] font-semibold max-w-[410px] mx-auto md:leading-[41px]">Report a Lost or Stolen Watch</h2>
    <form class="mt-5 flex flex-col gap-5" id="stolen_watch">
        <div class="relative">
            <input type="text" placeholder="Rolex" class="border-[#C0C0C0] border text-[#70776F] outline-black rounded-[5px] w-full" required/>
            <span class="bg-white p-1 text-sm text-[#70776F] absolute -top-[15px] left-3">Watch Brand</span>
        </div>
        <div class="grid grid-cols-2 gap-5">
            <input type="text" placeholder="Model" class="border-[#C0C0C0] border text-[#70776F] outline-black rounded-[5px] w-full" required/>
            <input type="text" placeholder="Serial no" class="border-[#C0C0C0] border text-[#70776F] outline-black rounded-[5px] w-full" required/>
        </div>
        <div class="grid grid-cols-2 gap-5">
            <input type="date" placeholder="dd/mm/yyyy" class="border-[#C0C0C0] border text-[#70776F] outline-black rounded-[5px] w-full"/>
            <div class="border-[#C0C0C0] border flex items-center px-5 text-[#70776F] outline-black rounded-[5px] w-full">
                <svg width="10" height="15" viewBox="0 0 10 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 7.25986C4.5264 7.25986 4.0722 7.07549 3.73731 6.7473C3.40242 6.41911 3.21429 5.97399 3.21429 5.50986C3.21429 5.04573 3.40242 4.60062 3.73731 4.27243C4.0722 3.94424 4.5264 3.75986 5 3.75986C5.4736 3.75986 5.9278 3.94424 6.26269 4.27243C6.59758 4.60062 6.78571 5.04573 6.78571 5.50986C6.78571 5.73968 6.73953 5.96724 6.64979 6.17956C6.56004 6.39188 6.42851 6.5848 6.26269 6.7473C6.09687 6.9098 5.90002 7.03871 5.68336 7.12665C5.46671 7.2146 5.2345 7.25986 5 7.25986ZM5 0.609863C3.67392 0.609863 2.40215 1.12611 1.46447 2.04504C0.526784 2.96397 0 4.2103 0 5.50986C0 9.18486 5 14.6099 5 14.6099C5 14.6099 10 9.18486 10 5.50986C10 4.2103 9.47322 2.96397 8.53553 2.04504C7.59785 1.12611 6.32608 0.609863 5 0.609863Z" fill="#888E87"/>
                </svg>
                <input type="text" placeholder="I-11, Islamabad" class="w-full border-none outline-none" />
            </div>
        </div>
        <h4 class="text-[#2B2B2B] font-medium text-lg text-center">Contact Info</h4>
        <div class="grid grid-cols-2 gap-5">
            <input type="text" placeholder="Name" class="border-[#C0C0C0] border text-[#70776F] outline-black rounded-[5px] w-full" required/>
            <input type="email" placeholder="Email" class="border-[#C0C0C0] border text-[#70776F] outline-black rounded-[5px] w-full" required/>
        </div>
        <div class="border-[#C0C0C0] border flex items-center px-5 text-[#70776F] outline-black rounded-[5px] w-full">
            <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                <path d="M2.81556 6.05889C3.93556 8.26 5.74 10.0567 7.94111 11.1844L9.65222 9.47333C9.86222 9.26333 10.1733 9.19333 10.4456 9.28667C11.3167 9.57444 12.2578 9.73 13.2222 9.73C13.65 9.73 14 10.08 14 10.5078V13.2222C14 13.65 13.65 14 13.2222 14C5.91889 14 0 8.08111 0 0.777778C0 0.35 0.35 0 0.777778 0H3.5C3.92778 0 4.27778 0.35 4.27778 0.777778C4.27778 1.75 4.43333 2.68333 4.72111 3.55444C4.80667 3.82667 4.74444 4.13 4.52667 4.34778L2.81556 6.05889Z" fill="#888E87"/>
            </svg>
            <input type="text" placeholder="Ph no" class="w-full border-none outline-none" />
        </div>
        <h4 class="text-[#2B2B2B] font-medium text-lg text-center">Upload proof</h4>
        <div>
            <label for="file-upload" class="w-full max-w-2xl h-36 border-2 border-dashed border-gray-400 bg-gray-50 flex flex-col items-center justify-center cursor-pointer hover:bg-gray-100 transition p-4 rounded-md">
                <svg class="w-10 h-10 text-gray-500 mb-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 12l5-5m0 0l5 5m-5-5v12"></path>
                </svg>
                <p class="text-gray-600 text-sm">Upload Images from four sides</p>
                <p class="text-gray-500 text-xs">(Each from one side)</p>
                <input type="file" id="file-upload" class="hidden">
            </label>
        </div>
        <textarea className="border-[#C0C0C0] _textarea border flex items-center !p-3 text-[#70776F] outline-black rounded-[5px] w-full"
            style="padding:10px; border: 1px solid #C0C0C0; border-radius: 5px; height:130px " required
        >Description</textarea>
        <button type="submit" class="font-bold text-2xl bg-[#B6E22E] w-full p-4 hover:bg-black hover:text-[#B6E22E]">Confirm</button>
    </form>
  </div>
</div>


<style>
  /* Modal styles */
  .modal {
    display: none; 
    position: fixed; 
    z-index: 1000; 
    left: 0;
    top: 0;
    overflow-y: auto;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
  }
  .modal::-webkit-scrollbar {
    display: none;
   }

  .modal-content {
    background-color: white;
    margin: 8rem auto;
    border-radius: 10px;
    width: 100%;
    text-align: center;
    position: relative;
  }

  .close {
    position: absolute;
    right: 15px;
    top: 7px;
    font-size: 25px;
    cursor: pointer;
  }
</style>