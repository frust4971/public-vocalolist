import os
from os.path import join, dirname 
from dotenv import load_dotenv

def load_env():
    load_dotenv(join(dirname(__file__),"..","..",".env"))
