<div id="modal" class="modal">
  <div class="modal-content !max-w-[590px] p-[25px]">
    <span class="close">&times;</span>
    <?php report_stolen_watch(); ?>
    
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