import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import SelectInput from "@/Components/SelectInput";

import TextInput from "@/Components/TextInput";
import AuthenticatedAdmin from "@/Layouts/AuthenticatedAdminLayout";
import { Head, Link, useForm } from "@inertiajs/react";

export default function Edit({ auth, product,company,baseUrl }) {
   const { data, setData, post, processing, errors, reset } = useForm({

      name: product.name || "",
      code: product.code || "",
      price: product.price || "",
      package: product.package || "",
      unit:product.unit|| "",
      price: product.price || "",
      imageUrl: "",
      _method:'PUT'
   
   });
   const onSubmit = (e) => {
      e.preventDefault();

      post(route('product.update',[company.id, product.id]));
   }
   return (
      <AuthenticatedAdmin
         user={auth.user}
         header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Edit Product "{product.name}"</h2>}>
         <Head title="Create New Product" />

         <div className="py-12">
            <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
               <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                  <form className="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg"
                     onSubmit={onSubmit}>
                     
                     {product.imageUrl && <div className="mb-4">
                        <img src={`${baseUrl}/storage/${product.imageUrl}`} className="w-35 h-35" alt="" /></div>}

                     <div>
                        <InputLabel
                           htmlFor="product_logo_url_path"
                           value="Product Image"
                        />
                        <TextInput
                           id="product_logo_url_path"
                           type="file"
                           name="imageUrl"
                           className="mt-1 block w-full"
                           onChange={e => setData('imageUrl', e.target.files[0] )}
                        />
                        <InputError message={errors.imageUrl} className="mt-2 " />
                     </div>



                     <div className="mt-4">
                        <InputLabel
                           htmlFor="product_name"
                           value="Product Name"
                        />
                        <TextInput
                           id="product_name"
                           type="text"
                           name="name"
                           value={data.name}
                           isFocused="true"
                           className="mt-1 block w-full"
                           onChange={e => setData('name', e.target.value)}
                        />
                        <InputError message={errors.name} className="mt-2 " />
                     </div>
                     <div className="mt-4">
                        <InputLabel
                           htmlFor="product_code"
                           value="Product Code"
                        />
                        <TextInput
                           id="product_code"
                           name="code"
                           value={data.code}
                           type="code"
                           className="mt-1 block w-full"
                           onChange={e => setData('code', e.target.value)}
                        />
                        <InputError message={errors.code} className="mt-2 " />
                     </div>
                     <div className="mt-4">
                        <InputLabel
                           htmlFor="product_price"
                           value="Product Price"
                        />
                        <TextInput
                           id="product_price"
                           name="price"
                           value={data.price}
                           type="number"
                           className="mt-1 block w-full"
                           onChange={e => setData('price', e.target.value)}
                        />
                        <InputError message={errors.price} className="mt-2 " />
                     </div>

                     <div className="mt-4">
                        <InputLabel
                           htmlFor="product_package"
                           value="Product Package"
                        />
                        <TextInput
                           id="product_package"
                           name="package"
                           value={data.package}
                           type="text"
                           className="mt-1 block w-full"
                           onChange={e => setData('package', e.target.value)}
                        />
                        <InputError message={errors.package} className="mt-2 " />
                     </div>

                     <div className="mt-4">
                        <InputLabel
                           htmlFor="product_unit"
                           value="Product Unit"
                        />
                        <TextInput
                           id="product_unit"
                           name="unit"
                           value={data.unit}
                           type="text"
                           className="mt-1 block w-full"
                           onChange={e => setData('unit', e.target.value)}
                        />
                        <InputError message={errors.unit} className="mt-2 " />
                     </div>
                     <div className="mt-4 text-right">
                        <Link href={route('product.index',company.id)} className="inline-block bg-gray-100 py-1 px-3 text-gray-800 rounded shadow transition-all horver:bg-gray-200 mr-2">Cancel</Link>

                        <button className="bg-emerald-500 py-1 px-3 text-white rounded shadow transition-all hover:bg-emerald-600" >Submit</button>

                     </div>
                  </form>
               </div>
            </div>

         </div>
      </AuthenticatedAdmin>
   );
}