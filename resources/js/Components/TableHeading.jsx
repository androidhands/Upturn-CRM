import { ChevronUpIcon, ChevronDownIcon} from '@heroicons/react/16/solid'

export default function TableHeading({ field, sortable = true, sort_field = null, sort_direction = null, children,
   sortChanged = ()=>{}
}) {
   return (
      <th onClick={(e) => sortChanged(field)} 
      ><div className=
      "px-3 py-3 flex items-center justify-between gap-1 cursor-pointer" >
            {children}
         
         {sortable && (<div>
            <ChevronUpIcon className={ 
               "w-4" + (
                  sort_field === field && sort_direction ==='asc'?" text-white":""
               )
             } />
         <ChevronDownIcon  className={ 
               "w-4 -mt-2" + (
                  sort_field === field && sort_direction ==='desc'?" text-white":""
               )
             } />
      </div>)}
      </div>
   </th>
   );
}