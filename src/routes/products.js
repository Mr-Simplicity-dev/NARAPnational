import express from 'express';
import Product from '../models/Product.js';
import { buildCRUDRoutes } from './_util.js';

const router = express.Router();
buildCRUDRoutes({ router, Model: Product, resource: 'products' });
export default router;
