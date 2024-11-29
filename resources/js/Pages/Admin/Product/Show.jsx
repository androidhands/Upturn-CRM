import { Head, Link, router } from "@inertiajs/react";
import AuthenticatedAdmin from "@/Layouts/AuthenticatedAdminLayout";

export default function Show({ auth, product, company, baseUrl }) {


   return (
      <AuthenticatedAdmin
         user={auth.user}
         header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{`Product ${product.name}`}</h2>}>
         <Head title={`Product ${product.name}`} />
         <div className="py-12">
            <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
               <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                  <div>
                     <img src={`${baseUrl}/storage/${product.imageUrl}`} alt="" className="w-full h-64 object-fill" />
                  </div>

                  <div className="p-6 text-gray-900 dark:text-gray-100">

                     <div className="overflow-auto">


                        <div className="grid gap-1 grid-cols-2 mt-2">
                           {/* left side of grid */}
                           <div>
                              <div>
                                 <label className="font-bold text-lg">Product ID</label>
                                 <p className="mt-1">{product.id}</p>
                              </div>
                              <div className="mt-4">
                                 <label className="font-bold text-lg">Product Name</label>
                                 <p className="mt-1">{product.name}</p>
                              </div>
                              <div className="mt-4">
                                 <label className="font-bold text-lg">Product Price</label>
                                 <p className="mt-1">{product.price}</p>
                              </div>



                           </div>
                           {/* right side of grid */}
                           <div>
                              <div>
                                 <label className="font-bold text-lg">Product Code</label>
                                 <p className="mt-1">{product.code}</p>
                              </div>
                              <div className="mt-4">
                                 <label className="font-bold text-lg">Product Package</label>
                                 <p className="mt-1">{product.package}</p>
                              </div>
                              <div className="mt-4">
                                 <label className="font-bold text-lg">Product Unit</label>
                                 <p className="mt-1">{product.unit}</p>
                              </div>

                           </div>
                        </div>
                        <div className="mt-4 text-right">
                           <Link href={route('product.index', company.id)} className="inline-block bg-gray-100 py-1 px-3 text-gray-800 rounded shadow transition-all horver:bg-gray-200 mr-2">Cancel</Link>
                        </div>

                     </div>
                  </div>
               </div>
            </div>
         </div>



      </AuthenticatedAdmin>
   );

}