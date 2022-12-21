<div class="searching__div">
       

       <div>
           <form method="POST" >

           <div class="d-flex-c f-sv f-wrap">

           <div class="d-flex-c">

           <div class="dropdown">
                       <span>
                           <img class="card_small_icon" src="<?= $imgAssets . '/icons/angle-arrow-down.png' ?>" alt="">
                         
                       </span>
                       <div class="dropdown-content">
                           
                           <div class="dropdown_item" >
                               <span> Facility Name</span>
                               <input name="checkbox_1" type="checkbox" id="1" value="Facility Name" onclick="getSelectItemThat(this.id)" />
                           </div>
                           
                           <div class="dropdown_item" >
                               <span> City</span>
                               <input name="checkbox_2" type="checkbox" id="2" value="City" onclick="getSelectItemThat(this.id)" />
                           </div>
                           
                           <div class="dropdown_item" >
                               <span> Street</span>
                               <input name="checkbox_3" type="checkbox" id="3" value="Street" onclick="getSelectItemThat(this.id)" />
                           </div>
                           
                           <div class="dropdown_item" >
                               <span> Number </span>
                               <input name="checkbox_4" type="checkbox" id="4" value="Number" onclick="getSelectItemThat(this.id)" />
                           </div>
                          
                           <!-- <input type="submit" name="filter_search" class="table_btn"  > -->

                         
                          
                       </div>
             
                

                   
               </div>
           </div>

           <div class="search__single--div">   
                    
<input name="search_query" type="text" class="search-input">

<button type="submit" name="search_blog" value="Search" class="search_query-btn click_pointer">Search</button>

  </div>
           </div>


         
              
                    

                     
        </div>
    </form>


  
</div>
