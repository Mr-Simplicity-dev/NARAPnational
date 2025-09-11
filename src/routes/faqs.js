import express from 'express';
import FAQ from '../models/FAQ.js';
import { buildCRUDRoutes } from './_util.js';

const router = express.Router();
buildCRUDRoutes({ router, Model: FAQ, resource: 'faqs' });

export default router;
