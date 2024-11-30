import { Head, Link, router } from "@inertiajs/react";
import AuthenticatedAdmin from "@/Layouts/AuthenticatedAdminLayout";
import PageHeader from "@/Components/PageHeader";
import SvgDistrict from "@/Components/SvgIcons/District";
import NavLink from "@/Components/NavLink";

export default function Show({ auth, governorate, country }) {

   const breadcrumbs = [
      { name: country.name, href: route('country.show', country.id) },
      { name: 'Governorates', href: route('governorate.index', country.id) },
      { name: governorate.name, href: route('governorate.show', [country.id, governorate.id]) },


   ];
   return (
      <AuthenticatedAdmin
         user={auth.user}
         header={
            <PageHeader breadcrumbs={breadcrumbs}/>
         }>
         <Head title={`Governorate ${governorate.name}`} />
         <div className="py-12">
            <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
               <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                  <div className="p-6 text-gray-900 dark:text-gray-100">
                     <div className="overflow-auto">
                        <div className="grid gap-1 grid-cols-2 mt-2">
                           {/* left side of grid */}
                           <div>
                              <div>
                                 <label className="font-bold text-lg">Governorate ID</label>
                                 <p className="mt-1">{governorate.id}</p>
                              </div>
                              <div className="mt-4">
                                 <label className="font-bold text-lg">Governorate Name</label>
                                 <p className="mt-1">{governorate.name}</p>
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
                  <Link href={route('governorate.index', country.id)} className="ingovernorate-block bg-gray-100 py-1 px-3 text-gray-800 rounded shadow transition-all horver:bg-gray-200 mr-2">Cancel</Link>
               </div>
            </div>


         </div>

         <div className="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
            <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
               <div className="mb-4 mt-4 items-center">
               <NavLink href={route(`city.index`,[country.id, governorate.id])}
                  >
                     <div className="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-green-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500" >
                        <div className="h-16 w-16 bg-green-50 dark:bg-green-800/20 flex items-center justify-center rounded-full">
                           <SvgDistrict className="w-7 h-7 stroke-green-500" color="green" />
                        </div>
                        <h4 className="mt-6 ml-2 text-s font-semibold text-gray-900 dark:text-white">
                           Cities
                        </h4>

                     </div>
                  </NavLink>
               </div>
            </div>
            </div>

      </AuthenticatedAdmin>
   );

}