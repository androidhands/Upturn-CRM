import { Head, router } from "@inertiajs/react";
import AuthenticatedAdmin from "@/Layouts/AuthenticatedAdminLayout";

export default function Show({ auth, user,company }) {
   

   return (
      <AuthenticatedAdmin
         user={auth.user}
         header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{`${company.name}/Users/${user.name}` }</h2>}>
         <Head title={`User ${user.name}`} />
         <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
               <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                  <div className="p-6 text-gray-900 dark:text-gray-100">
                     <div className="overflow-auto">
                        <div className="grid gap-1 grid-cols-2 mt-2">
                           {/* left side of grid */}
                           <div>
                              <div>
                                 <label className="font-bold text-lg">User ID</label>
                                 <p className="mt-1">{user.id }</p>
                              </div>
                              <div className="mt-4">
                                 <label className="font-bold text-lg">User Name</label>
                                 <p className="mt-1">{user.name }</p>
                              </div>
                              <div className="mt-4">
                                 <label className="font-bold text-lg">Email</label>
                                 <p className="mt-1">{user.email }</p>
                              </div>
                              
                              
                           </div>
                            {/* right side of grid */}
                           <div>
                           <div className="mt-4">
                                 <label className="font-bold text-lg">Email Verification</label>
                                 <p className="mt-1">{user.email_verified_at ? `Verified`: `Not Verified` }</p>
                              </div>
                              
                            </div>
                        </div>
                       
                     </div>
                  </div>
               </div>
            </div>
            
            <div className="mt-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
               <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                  <div className="p-6 text-gray-900 dark:text-gray-100">
                     
                  </div>
               </div>
               </div>
         </div>
        

         
      </AuthenticatedAdmin>
   );
   
}