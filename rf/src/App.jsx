// import './bootstrap.css';
import './App.css';
import getPage from './Js/urlController';
import { useEffect, React } from 'react';
import Main from './pages/Main';
import axios from 'axios';

function App()
{
  axios.defaults.withCredentials = true;

  return (
    <div className='body'>
      <Main />
    </div>
  );
}

export default App;
