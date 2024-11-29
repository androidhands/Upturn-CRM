import { Head, Link, router } from "@inertiajs/react";
import AuthenticatedAdmin from "@/Layouts/AuthenticatedAdminLayout";
import PageHeader from "@/Components/PageHeader";

export default function Show({ auth, line, company }) {

   const breadcrumbs = [
      { name: company.name, href: route('company.show', company.id) },
      { name: 'Lines', href: route('line.index', company.id) },
      { name: line.name, href: route('line.show', [company.id, line.id]) },


   ];
   return (
      <AuthenticatedAdmin
         user={auth.user}
         header={
            <PageHeader breadcrumbs={breadcrumbs}/>
         }>
         <Head title={`Line ${line.name}`} />
         <div className="py-12">
            <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
               <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                  <div className="p-6 text-gray-900 dark:text-gray-100">
                     <div className="overflow-auto">
                        <div className="grid gap-1 grid-cols-2 mt-2">
                           {/* left side of grid */}
                           <div>
                              <div>
                                 <label className="font-bold text-lg">Line ID</label>
                                 <p className="mt-1">{line.id}</p>
                              </div>
                              <div className="mt-4">
                                 <label className="font-bold text-lg">Line Name</label>
                                 <p className="mt-1">{line.name}</p>
                              </div>

                           </div>
                           {/* right side of grid */}
                           <div>


                           </div>
                        </div>

                     </div>
                  </div>
               </div>
               <div className="mt-4 text-right">
                  <Link href={route('line.index', company.id)} className="inline-block bg-gray-100 py-1 px-3 text-gray-800 rounded shadow transition-all horver:bg-gray-200 mr-2">Cancel</Link>
               </div>
            </div>


         </div>



      </AuthenticatedAdmin>
   );

}