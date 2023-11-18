import '@/styles/globals.css'
import Head from 'next/head';
import { ThemeProvider } from "@material-tailwind/react";
import RecipeRating from "@/pages/recipeRating";
export default function App({ Component, pageProps }) {
  return (
      <>
        <Head>
          <title>RapidAPI - Recipe App</title>
          <link rel="icon" href="/favicon.ico" />
          <link
              href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;600;700;800&display=swap"
              rel="stylesheet"
          />
        </Head>
          <ThemeProvider>
          {/*<Component {...pageProps} />*/}
              <RecipeRating/>
          </ThemeProvider>

      </>
  );
}
