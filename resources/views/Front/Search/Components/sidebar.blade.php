<aside id="separator-sidebar"
class="w-1/3 relative top-0  hidden md:block left-0 z-999 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
aria-label="Sidebar">
<div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
    <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700">
           
        <li class="flex  justify-bewteen flex-wrap">
            @foreach ($categories as $category)
            <a href="#">
                <span class="flex bg-blue-100 w-[95%] text-green-800 text-xs 
                font-medium me-2 p-2 rounded dark:bg-gray-700 dark:text-blue-400
                 border border-blue-400 mt-2 mb-2">{{ucfirst($category->category_name)}}</span>
            </a>

            @endforeach

         

        </li>
        
    </ul>

    <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700">
           
        <li class="flex  justify-bewteen flex-wrap">
            @foreach ($organs as $organ)
            <a href="#">
                <span class="flex bg-blue-100 w-[95%] text-green-800 text-xs 
                font-medium me-2 p-2 rounded dark:bg-gray-700 dark:text-blue-400
                 border border-blue-400 mt-2 mb-2">{{ucfirst($organ->name)}}</span>
            </a>

            @endforeach

         

        </li>
        
    </ul>


</div>
</aside>
