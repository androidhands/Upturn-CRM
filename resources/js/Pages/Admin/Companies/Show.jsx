import AuthenticatedAdmin from "@/Layouts/AuthenticatedAdminLayout";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, router } from "@inertiajs/react";


export default function Show({ auth, country , baseUrl}) {
   

   return (
      <AuthenticatedAdmin
         user={auth.user}
         header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{`Country ${country.name}` }</h2>}>
         <Head title={`Country ${country.name}`} />
         <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
               <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                 
                  <div>
                        <img src={`${baseUrl}/storage/${country.flagUrl}`} alt="" className="w-full h-64 object-fill" />
                        </div>
                  <div className="p-6 text-gray-900 dark:text-gray-100">
                     
                     <div className="overflow-auto">
                      
                      
                        <div className="grid gap-1 grid-cols-2 mt-2">
                           {/* left side of grid */}
                           <div>
                              <div>
                                 <label className="font-bold text-lg">Country ID</label>
                                 <p className="mt-1">{country.id }</p>
                              </div>
                              <div className="mt-4">
                                 <label className="font-bold text-lg">Country Name</label>
                                 <p className="mt-1">{country.name }</p>
                              </div>
                              <div className="mt-4">
                                 <label className="font-bold text-lg">Country Code</label>
                                 <p className="mt-1">{country.code }</p>
                              </div>

                              <div className="mt-4">
                                 <label className="font-bold text-lg">Phone Code</label>
                                 <p className="mt-1">{country.phoneCode }</p>
                              </div>
                            
                           </div>
                            {/* right side of grid */}
                           <div>
                          
                              <div className="mt-4">
                                 <label className="font-bold text-lg">Create Date</label>
                                 <p className="mt-1">{country.created_at }</p>
                              </div>
                              <div className="mt-4">
                                 <label className="font-bold text-lg">Update Date</label>
                                 <p className="mt-1">{country.updated_at }</p>
                              </div>
                            </div>
                        </div>
                      
                     </div>
                  </div>
               </div>
            </div>
         </div>
         
      </AuthenticatedAdmin>
   );
   
}