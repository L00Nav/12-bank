// import './bootstrap.css';
import './App.css';
import getPage from './Js/urlController';
import { useEffect, React } from 'react';
import Main from './pages/Main';

function App()
{
  //default page - login
  //responses direct the use of page components
  // const Page = CreateAdmin; //[getPage()];
  //useEffect(() => {console.log(getPage())}, [])

  return (
    <div className='body'>
      <Main />
    </div>
  );
}

export default App;
