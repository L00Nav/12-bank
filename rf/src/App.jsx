// import './bootstrap.css';
import './App.css';
import { React } from 'react';
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
