import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import TextInput from "@/Components/TextInput";
import AuthenticatedAdmin from "@/Layouts/AuthenticatedAdminLayout";
import { Head, Link, useForm } from "@inertiajs/react";

export default function Create({ auth, company }) {
   const { data, setData, post, processing, errors, reset } = useForm({
      name: '',
      email: '',
      password: '',
      password_confirmation: '',

   });
   const onSubmit = (e) => {
      e.preventDefault();

      post(route("user.store",company.id));
   }
   return (
      <AuthenticatedAdmin
         user={auth.user}
         header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Create New User</h2>}>
         <Head title="Create New User" />

         <div className="py-12">
            <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
               <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                  <form className="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg"
                     
                     onSubmit={onSubmit}>
                     <div className="mt-4">
                        <InputLabel
                           htmlFor="user_name"
                           value="User Name"
                        />
                        <TextInput
                           id="user_name"
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
                           htmlFor="user_email"
                           value="User Email"
                        />
                        <TextInput
                           id="user_email"
                           name="email"
                           value={data.email}
                           type="email"
                           className="mt-1 block w-full"
                           onChange={e => setData('email', e.target.value)}
                        />
                        <InputError message={errors.email} className="mt-2 " />
                     </div>

                     <div className="mt-4">
                        <InputLabel
                           htmlFor="user_password"
                           value="Password"
                        />
                        <TextInput
                           id="user_password"
                           name="password"
                           value={data.password}
                           type="password"
                           className="mt-1 block w-full"
                           onChange={e => setData('password', e.target.value)}
                        />
                        <InputError message={errors.password} className="mt-2 " />
                     </div>
                     <div className="mt-4">
                        <InputLabel
                           htmlFor="user_password_confirmation"
                           value="Confirmation Password"
                        />
                        <TextInput
                           id="user_password_confirmation"
                           name="password_confirmation"
                           value={data.password_confirmation}
                           type="password"
                           className="mt-1 block w-full"
                           onChange={e => setData('password_confirmation', e.target.value)}
                        />
                        <InputError message={errors.password_confirmation} className="mt-2 " />
                     </div>
                     <div className="mt-4 text-right">
                        <Link href={route('user.index',company.id)} className="inline-block bg-gray-100 py-1 px-3 text-gray-800 rounded shadow transition-all horver:bg-gray-200 mr-2">Cancel</Link>
                        <button className="bg-emerald-500 py-1 px-3 text-white rounded shadow transition-all hover:bg-emerald-600" >Submit</button>

                     </div>
                  </form>
               </div>
            </div>

         </div>
      </AuthenticatedAdmin>
   );
}