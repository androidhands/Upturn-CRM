import { Head, router, useForm } from "@inertiajs/react";
import AuthenticatedAdmin from "@/Layouts/AuthenticatedAdminLayout";
import PageHeader from "@/Components/PageHeader";
import InputLabel from "@/Components/InputLabel";
import SelectInput from "@/Components/SelectInput";
import InputError from "@/Components/InputError";
import TextInput from "@/Components/TextInput";
import { EDUCATION_DEGREE_LIST, MILITARY_STATUS_LIST } from "@/Pages/Constants/Constants";
import ReactDatePicker from "react-datepicker";
import "react-datepicker/dist/react-datepicker.css";

export default function Show({ auth, employee,user, company }) {
   const { data, setData, post, errors, reset } = useForm({
      role: '',
      date_of_birth: '',
      gender: '',
      graduationYear: '',
      militaryStatus:'',
   });
   const onSubmit = (e) => {
      e.preventDefault();

      post(route("company.store"));
   }

   const breadcrumbs = [
      { name: user.name, href: route('user.show', company.id) },
   ];
   return (
      <AuthenticatedAdmin
      user={auth.user}
         header={
            <PageHeader breadcrumbs={breadcrumbs} />
         }>
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
                                 <p className="mt-1">{employee.id}</p>
                              </div>
                              <div className="mt-4">
                                 <label className="font-bold text-lg">User Name</label>
                                 <p className="mt-1">{employee.name}</p>
                              </div>
                              <div className="mt-4">
                                 <label className="font-bold text-lg">Email</label>
                                 <p className="mt-1">{employee.email}</p>
                              </div>


                           </div>
                           {/* right side of grid */}
                           <div>
                              <div className="mt-4">
                                 <label className="font-bold text-lg">Email Verification</label>
                                 <p className="mt-1">{employee.verified ? `Verified` : `Not Verified`}</p>
                              </div>

                           </div>
                        </div>

                     </div>
                  </div>
               </div>
            </div>

            {employee.verified &&
               <div className="mt-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
                  <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                     <div className="p-6 text-gray-900 dark:text-gray-100">
                        <div className="text-gray-900 dark:text-gray-100">Setup User As Employee</div>
                        <form>

                           <div className="mt-4">
                              <InputLabel
                                 htmlFor="employee_role"
                                 value="Employee Role"
                              />
                              <SelectInput
                                 id="employee_role"
                                 name="role"
                                 className="mt-1 block w-full"
                                 onChange={e => setData('role', e.target.value)}
                              >
                                 <option value="">Select Role</option>
                                 {roles.data.map((role) => (
                                    <option key={role.id} value="role">{role.name}</option>
                                 ))}
                              </SelectInput>
                              <InputError message={errors.code} className="mt-2 " />
                           </div>
                           <div className="mt-4">
                              <InputLabel
                                 htmlFor="date_of_birth"
                                 value="Birth Date"
                              />
                              <TextInput
                                 id="date_of_birth"
                                 type="date"
                                 name="date_of_birth"
                                 value={data.date_of_birth}

                                 className="mt-1 block w-full dark-calendar-icon"
                                 onChange={e => setData('date_of_birth', e.target.value)}
                              />
                              <InputError message={errors.date_of_birth} className="mt-2 " />
                           </div>

                           <div className="mt-4">
                              <InputLabel
                                 htmlFor="employee_gender"
                                 value="Employee Gender"
                              />
                              <SelectInput
                                 id="employee_gender"

                                 name="gender"
                                 className="mt-1 block w-full"
                                 onChange={e => setData('gender', e.target.value)}
                              >
                                 <option value="">Select Gender</option>
                                 <option value="male">Male</option>
                                 <option value="female">Female</option>

                              </SelectInput>
                              <InputError message={errors.gender} className="mt-2 " />
                           </div>


                           <div className="mt-4">
                              <InputLabel
                                 htmlFor="employee_education_degree"
                                 value="Education Degree"
                              />
                              <SelectInput
                                 id="employee_education_degree"
                                 name="educationDegree"
                                 className="mt-1 block w-full"
                                 onChange={e => setData('educationDegree', e.target.value)}
                              >
                                 <option value="">Select Education Degree</option>

                                 {EDUCATION_DEGREE_LIST.map((degree) => (
                                    <option key={EDUCATION_DEGREE_LIST.indexOf(degree)} value={degree}>{degree}</option>
                                 ))}

                              </SelectInput>
                              <InputError message={errors.educationDegree} className="mt-2 " />
                           </div>
                           <div className="mt-4">
                              <InputLabel htmlFor="employee_graduation_year" value="Graduation Year" />
                              <ReactDatePicker
                                 id="employee_graduation_year"
                                 selected={data.graduationYear ? new Date(data.graduationYear, 0, 1) : null}
                                 onChange={(date) => setData('graduationYear', date ==null?'': date.getFullYear())}
                                 showYearPicker
                                 dateFormat="yyyy"
                                 className="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 focus:border-green-500 dark:focus:border-green-600 focus:ring-green-500 dark:focus:ring-green-600 rounded-md shadow-sm dark:text-white"
                              />
                              <InputError message={errors.graduationYear} className="mt-2" />
                           </div>
                           <div className="mt-4">
                              <InputLabel
                                 htmlFor="employee_military_status"
                                 value="Military Status"
                              />
                              <SelectInput
                                 id="employee_military_status"
                                 name="militaryStatus"
                                 className="mt-1 block w-full"
                                 onChange={e => setData('militaryStatus', e.target.value)}
                              >
                                 <option value="">Select Military Status</option>

                                 {MILITARY_STATUS_LIST.map((status) => (
                                    <option key={MILITARY_STATUS_LIST.indexOf(status)} value={status}>{status}</option>
                                 ))}

                              </SelectInput>
                              <InputError message={errors.militaryStatus} className="mt-2 " />
                           </div>

                        </form>

                     </div>
                  </div>
               </div>
            }
         </div>



      </AuthenticatedAdmin>
   );

}
