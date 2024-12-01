import { Link } from "@inertiajs/react";
import NextArrow from "./SvgIcons/NextArrow";

export default function CompanySetup({ svgImage, title, description, target }) {
   return (
     <Link
       href={target}
       className="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex items-center motion-safe:hover:scale-[1.01] transition-all duration-10 focus:outline focus:outline-2 focus:outline-green-500"
     >
       <div className="flex-grow">
         <div className="flex items-center gap-4">
           {svgImage}
           <h2 className="text-xl font-semibold text-gray-900 dark:text-white">
             {title}
           </h2>
         </div>
         <p className="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
           {description}
         </p>
       </div>
       {/* Center Right Aligned NextArrow */}
       <div className="flex items-center justify-center ml-4">
         <NextArrow />
       </div>
     </Link>
   );
 }
 