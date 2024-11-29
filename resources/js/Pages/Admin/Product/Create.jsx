import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import TextInput from "@/Components/TextInput";
import AuthenticatedAdmin from "@/Layouts/AuthenticatedAdminLayout";
import { Head, Link, useForm } from "@inertiajs/react";

export default function Create({ auth, company }) {
   const { data, setData, post, processing, errors, reset } = useForm({
      name: '',
      code: '',
      price: '',
      imageUrl: '',
      package: '',
      unit: '',
   });
   const onSubmit = (e) => {
      e.preventDefault();

      post(route("product.store",company.id));
   }
   return (
      <AuthenticatedAdmin
         user={auth.user}
         header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Create New Product</h2>}>
         <Head title="Create New Product" />

         <div className="py-12">
            <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
               <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                  <form className="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg"
                     
                     onSubmit={onSubmit}>
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
                           type="text"
                           className="mt-1 block w-full"
                           onChange={e => setData('code', e.target.value)}
                        />
                        <InputError message={errors.email} className="mt-2 " />
                     </div>

                     <div className="mt-4">
                        <InputLabel
                           htmlFor="product_price"
                           value="Product Price"
                        />
                        <TextInput
                           id="product_price"
                           type="number"
                           name="price"
                           value={data.price}
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
                           type="text"
                           name="package"
                           value={data.package}
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
                           type="text"
                           name="unit"
                           value={data.unit}
                           className="mt-1 block w-full"
                           onChange={e => setData('unit', e.target.value)}
                        />
                        <InputError message={errors.unit} className="mt-2 " />
                     </div>
                     <div className="mt-4">
                        <InputLabel
                           htmlFor="image_path"
                           value="Product Image"
                        />
                        <TextInput
                           id="image_path"
                           type="file"
                           name="image"
                           className="mt-1 block w-full"
                           onChange={e => setData('imageUrl', e.target.files[0])}
                        />
                        <InputError message={errors.imageUrl} className="mt-2 " />
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